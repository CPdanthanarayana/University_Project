## Field Name Mapping Guide

### 🎯 **Current Status Summary:**

#### ✅ **MATCHING FIELDS:**
- `purpose` ✓
- `departure_date` ✓  
- `return_date` ✓
- `designation` ✓
- `faculty` ✓
- `department` ✓
- `contact_no` ✓

#### ⚠️ **FIELDS NEEDING UI FORM UPDATES:**

**Application Form Fields:**
- UI: `from` → Should be: `from_location` ✓ (already matches in backend)
- UI: `to` → Should be: `to_location` ✓ (already matches in backend)
- UI: `service_no_name` → Split into: `service_no` and `name`
- UI: `supporting_docs` (radio) → Should be: `supporting_docs` (file upload)
- UI: `applicant_signature` → Should be: `applicant_signature_path`
- UI: `applicant_date` → Should be: `applicant_signed_date`

**Travelers/Members Fields:**
- UI: `sn1_service_no, sn1_name, sn2_service_no, sn2_name...` 
- Should be: `members[0][service_no], members[0][name], members[1][service_no], members[1][name]...`

**Program/Visits Fields:**
- UI: `prog1_date, prog1_place, prog2_date, prog2_place...`
- Should be: `visits[0][visit_date], visits[0][location], visits[1][visit_date], visits[1][location]...`

#### 📋 **RECOMMENDED FORM FIELD UPDATES:**

1. **Split service_no_name field:**
   ```html
   <!-- OLD -->
   <input type="text" name="service_no_name">
   
   <!-- NEW -->
   <input type="text" name="service_no" placeholder="Service No.">
   <input type="text" name="name" placeholder="Name">
   ```

2. **Update location fields:**
   ```html
   <!-- OLD -->
   <input type="text" name="from">
   <input type="text" name="to">
   
   <!-- NEW -->
   <input type="text" name="from_location">
   <input type="text" name="to_location">
   ```

3. **Update members array structure:**
   ```html
   <!-- OLD -->
   <input type="text" name="sn1_service_no">
   <input type="text" name="sn1_name">
   
   <!-- NEW -->
   <input type="text" name="members[0][service_no]">
   <input type="text" name="members[0][name]">
   ```

4. **Update signature fields:**
   ```html
   <!-- OLD -->
   <input type="file" name="applicant_signature">
   <input type="date" name="applicant_date">
   
   <!-- NEW -->
   <input type="file" name="applicant_signature_path">
   <input type="date" name="applicant_signed_date">
   ```

5. **Update supporting docs to file upload:**
   ```html
   <!-- OLD -->
   <input type="radio" name="supporting_docs" value="yes"> Yes
   <input type="radio" name="supporting_docs" value="no"> No
   
   <!-- NEW -->
   <input type="file" name="supporting_docs" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
   ```

### 🎯 **CURRENT MODEL FILLABLES (CORRECT):**

**Application Model:**
```php
'user_id', 'applicant_id', 'purpose', 'documents_attached', 'supporting_docs', 
'program', 'from_location', 'to_location', 'departure_date', 'return_date', 
'applicant_signature_path', 'applicant_signed_date', 'status'
```

**Applicant Model:**
```php
'service_no', 'name', 'designation', 'faculty', 'department', 'contact_no'
```

**ApplicationMember Model:**
```php
'application_id', 'service_no', 'name'
```

**ApplicationVisit Model:** ✅ **UPDATED**
```php
'application_id', 'visit_date', 'visit_time', 'purpose', 'location', 'notes', 'status'
```

### 🚀 **NEXT STEPS:**
1. Run the new migration: `php artisan migrate`
2. Update the UI form field names as outlined above
3. Test the form submission with the ApplicationController
4. Regenerate models if needed: `php artisan code:models`
